package com.mirea.spring8.service;

import com.github.javafaker.Faker;
import org.springframework.stereotype.Service;

import java.util.*;
@Service
public class FixtureService {
    private final Random random = new Random();
    String[] genders = new String[]{"male", "female"};
    String[] browsers = new String[]{"Chrome", "Firefox", "Opera", "Internet Explorer", "Safari", "Microsoft Edge"};
    private final Faker faker = new Faker();


    public List<Map<String, String>> createFixtures(int amount){
        List<Map<String, String>> maps = new ArrayList<>();
        for (int i = 0; i < amount; i++){
            Map<String, String> map = new HashMap<>();
            map.put("firstName", faker.name().firstName());
            map.put("lastName", faker.name().lastName());
            map.put("gender", genders[random.nextInt(genders.length)]);
            map.put("age", String.valueOf(random.nextInt((80 - 10) + 1) + 10));
            map.put("username", faker.name().username());
            map.put("country", faker.country().name());
            map.put("job", faker.job().title());
            map.put("browser", browsers[random.nextInt(browsers.length)]);
            maps.add(map);
        }
        return maps;
    }
}
