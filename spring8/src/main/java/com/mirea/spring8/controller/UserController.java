package com.mirea.spring8.controller;

import com.mirea.spring8.model.User;
import com.mirea.spring8.service.UserService;
import lombok.RequiredArgsConstructor;
import org.springframework.stereotype.Controller;
import org.springframework.ui.Model;
import org.springframework.web.bind.annotation.*;

import java.util.List;

@Controller
@RequiredArgsConstructor
public class UserController {
    private final UserService userService;

    @GetMapping("/user")
    public String showUsers(@CookieValue(value = "theme", defaultValue = "light") String theme, @CookieValue(value = "lang", defaultValue = "ru") String lang, Model model) {
        List<User> users = userService.findAll();
        model.addAttribute("users", users);
        model.addAttribute("lang", lang);
        model.addAttribute("theme", theme);
        return "users";
    }

    @GetMapping("/user/api")
    public List<User> getUsers() {
        return userService.findAll();
    }

    @PostMapping("/user/api")
    public User saveUser(@RequestBody User user) {
        return userService.save(user);
    }

    @GetMapping("/user/api/{id}")
    public User getUser(@PathVariable int id) {
        return userService.findById(id).orElse(null);
    }

    @PutMapping("/user/api/{id}")
    public User updateUser(@RequestBody User user, @PathVariable int id) {
        return userService.findById(id)
                .map(newUser -> {
                    newUser.setName(user.getName());
                    newUser.setPassword(user.getPassword());
                    newUser.setRole(user.getRole());
                    return userService.save(newUser);
                })
                .orElseGet(() -> {
                    user.setId(id);
                    return userService.save(user);
                });
    }

    @DeleteMapping("/user/api/{id}")
    public void deleteUser(@PathVariable int id) {
        userService.deleteById(id);
    }
}
