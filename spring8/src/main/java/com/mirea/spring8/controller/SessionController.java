package com.mirea.spring8.controller;

import com.mirea.spring8.response.CookieResponse;
import jakarta.servlet.http.Cookie;
import jakarta.servlet.http.HttpServletResponse;
import jakarta.servlet.http.HttpSession;
import org.springframework.stereotype.Controller;
import org.springframework.ui.Model;
import org.springframework.web.bind.annotation.CookieValue;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PostMapping;

@Controller
public class SessionController {

    @GetMapping(value = "/session")
    public String home(@CookieValue(value = "theme", defaultValue = "light") String theme, @CookieValue(value = "lang", defaultValue = "ru") String lang, final Model model, final HttpSession session) {
        Integer counter = (Integer) session.getAttribute("COUNTER");
        if (counter == null) {
            counter = 1;
        } else counter++;
        session.setAttribute("COUNTER", counter);
        model.addAttribute("counter", counter);
        model.addAttribute("lang", lang);
        model.addAttribute("theme", theme);
        return "session";
    }

    @PostMapping("/preferences")
    public String setCookies(CookieResponse cookieResponse, HttpServletResponse response) {
        response.addCookie(new Cookie("theme", cookieResponse.getTheme()));
        response.addCookie(new Cookie("lang", cookieResponse.getLang()));
        return "index";
    }

    @GetMapping("/preferences")
    public String getPreferences(Model model) {
        CookieResponse cookieResponse = new CookieResponse();
        model.addAttribute("cookieResponse", cookieResponse);
        return "preferences";
    }
}
