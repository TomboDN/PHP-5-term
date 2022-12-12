package com.mirea.spring8.controller;

import org.springframework.stereotype.Controller;
import org.springframework.web.bind.annotation.GetMapping;

@Controller
public class AuthController {
    @GetMapping("/")
    public String getHomePage(){
        return "index";
    }

    @GetMapping("/login")
    String login() {
        return "login";
    }
    @GetMapping("/info")
    String info() {
        return "info";
    }
}
