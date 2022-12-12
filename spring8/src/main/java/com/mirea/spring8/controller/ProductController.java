package com.mirea.spring8.controller;

import com.mirea.spring8.model.Product;
import com.mirea.spring8.service.ProductService;
import lombok.RequiredArgsConstructor;
import org.springframework.stereotype.Controller;
import org.springframework.ui.Model;
import org.springframework.web.bind.annotation.*;

import java.util.List;

@Controller
@RequiredArgsConstructor
public class ProductController {
    private final ProductService productService;

    @GetMapping("/product")
    public String showProducts(@CookieValue(value = "theme", defaultValue = "light") String theme, @CookieValue(value = "lang", defaultValue = "ru") String lang,Model model){
        List<Product> users = productService.findAll();
        model.addAttribute("products", users);
        model.addAttribute("lang", lang);
        model.addAttribute("theme", theme);
        return "products";
    }
    @GetMapping("/product/api")
    public List<Product> getProducts(){
        return productService.findAll();
    }
    @PostMapping("/product/api")
    public Product saveProduct(@RequestBody Product product){
        return productService.save(product);
    }
    @GetMapping("/product/api/{id}")
    public Product getProduct(@PathVariable int id){
        return productService.findById(id).orElse(null);
    }
    @PutMapping("/product/api/{id}")
    public Product updateProduct(@RequestBody Product product, @PathVariable int id){
        return productService.findById(id)
                .map(newUser -> {
                    newUser.setName(product.getName());
                    newUser.setVolume(product.getVolume());
                    newUser.setDescription(product.getDescription());
                    newUser.setPrice(product.getPrice());
                    newUser.setCreated(product.getCreated());
                    return productService.save(newUser);
                })
                .orElseGet(() -> {
                    product.setId(id);
                    return productService.save(product);
                });
    }
    @DeleteMapping("/product/api/{id}")
    public void deleteProduct(@PathVariable int id){
        productService.deleteById(id);
    }
}
