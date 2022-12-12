package com.mirea.spring8.controller;

import com.mirea.spring8.service.FixtureService;
import com.mirea.spring8.service.WatermarkService;
import jakarta.servlet.http.HttpServletRequest;
import jakarta.servlet.http.HttpServletResponse;
import lombok.RequiredArgsConstructor;
import org.apache.commons.io.FileUtils;
import org.springframework.stereotype.Controller;
import org.springframework.ui.Model;
import org.springframework.web.bind.annotation.*;
import org.springframework.web.servlet.ModelAndView;

import java.io.File;
import java.io.IOException;
import java.util.Base64;
import java.util.HashMap;
import java.util.List;
import java.util.Map;

@Controller
@RequiredArgsConstructor
public class StatisticsController {
    private final FixtureService fixtureService;
    private final WatermarkService watermarkService;

    @GetMapping("/graphs")
    public String generateGraphs(@CookieValue(value = "theme", defaultValue = "light") String theme, @CookieValue(value = "lang", defaultValue = "ru") String lang, Model model) {
        List<Map<String, String>> fixtures = fixtureService.createFixtures(60);
        Map<String, Integer> genderChart = new HashMap<>(Map.of("male", 0, "female", 0));
        Map<String, Integer> ageChart = new HashMap<>(Map.of("to18", 0, "from18to30", 0, "from30to50", 0, "from50to80", 0));
        Map<String, Integer> browsersBar = new HashMap<>(Map.of("Chrome", 0, "Firefox", 0, "Opera", 0, "InternetExplorer", 0, "Safari", 0, "MicrosoftEdge", 0));

        for (Map<String, String> map : fixtures) {
            switch (map.get("gender")) {
                case "male" -> genderChart.put("male", genderChart.get("male") + 1);
                case "female" -> genderChart.put("female", genderChart.get("female") + 1);
            }
            String age = map.get("age");
            if (Integer.parseInt(age) < 18) {
                ageChart.put("to18", ageChart.get("to18") + 1);
            } else if (Integer.parseInt(age) < 30) {
                ageChart.put("from18to30", ageChart.get("from18to30") + 1);
            } else if (Integer.parseInt(age) < 50) {
                ageChart.put("from30to50", ageChart.get("from30to50") + 1);
            } else {
                ageChart.put("from50to80", ageChart.get("from50to80") + 1);
            }

            switch (map.get("browser")) {
                case "Chrome" -> browsersBar.put("Chrome", browsersBar.get("Chrome") + 1);
                case "Firefox" -> browsersBar.put("Firefox", browsersBar.get("Firefox") + 1);
                case "Opera" -> browsersBar.put("Opera", browsersBar.get("Opera") + 1);
                case "Internet Explorer" ->
                        browsersBar.put("InternetExplorer", browsersBar.get("InternetExplorer") + 1);
                case "Safari" -> browsersBar.put("Safari", browsersBar.get("Safari") + 1);
                case "Microsoft Edge" -> browsersBar.put("MicrosoftEdge", browsersBar.get("MicrosoftEdge") + 1);
            }
        }

        model.addAttribute("genderChart", genderChart);
        model.addAttribute("ageChart", ageChart);
        model.addAttribute("browsersBar", browsersBar);
        model.addAttribute("lang", lang);
        model.addAttribute("theme", theme);
        return "graphs";
    }

    @RequestMapping(value = "/statistics", method = RequestMethod.POST)
    public void getGraphs(String data, HttpServletRequest request, HttpServletResponse response) throws InterruptedException {
        String[] split = data.split("data:image/png;base64,");
        for (int i = 1; i <= 3; i++) {
            try {
                split[i] = split[i].replace("\",\"", "");
                split[i] = split[i].replace("\"]", "");
                byte[] decodedBytes = Base64.getDecoder().decode(split[i].replace("\",\"", ""));
                String path = "fixtures/photo_" + i + ".png";
                FileUtils.writeByteArrayToFile(new File(path), decodedBytes);
                watermarkService.addImageWatermark(new File("fixtures/stamp.png"), "png", new File(path), new File(path));
            } catch (IOException e) {
                throw new RuntimeException(e);
            }
        }
    }

    @GetMapping("/statistics")
    public String showGraphs(@CookieValue(value = "theme", defaultValue = "light") String theme, @CookieValue(value = "lang", defaultValue = "ru") String lang, Model model) {
        for (int i = 1; i <= 3; i++) {
            try {
                byte[] fileContent;
                fileContent = FileUtils.readFileToByteArray(new File("fixtures/photo_" + i + ".png"));
                String encodedString = "data:image/png;base64," + Base64.getEncoder().encodeToString(fileContent);
                model.addAttribute("photo" + i, encodedString);
            } catch (IOException e) {
                throw new RuntimeException(e);
            }
        }
        model.addAttribute("lang", lang);
        model.addAttribute("theme", theme);
        return "statistics";
    }
}
