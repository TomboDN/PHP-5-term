package com.mirea.spring8.controller;

import com.mirea.spring8.service.StorageService;
import org.springframework.core.io.Resource;
import org.springframework.http.HttpHeaders;
import org.springframework.http.ResponseEntity;
import org.springframework.stereotype.Controller;
import org.springframework.ui.Model;
import org.springframework.web.bind.annotation.*;
import org.springframework.web.multipart.MultipartFile;
import org.springframework.web.servlet.support.ServletUriComponentsBuilder;

import java.util.Objects;
import java.util.stream.Collectors;

@Controller
public class FileController {

    private final StorageService storageService;

    public FileController(StorageService storageService) {
        this.storageService = storageService;
    }

    @GetMapping("/files")
    public String listAllFiles(@CookieValue(value = "theme", defaultValue = "light") String theme, @CookieValue(value = "lang", defaultValue = "ru") String lang,Model model) {

        model.addAttribute("files", storageService.loadAll().map(
                        path -> ServletUriComponentsBuilder.fromCurrentContextPath()
                                .path("/download/")
                                .path(path.getFileName().toString())
                                .toUriString())
                .collect(Collectors.toList()));
        model.addAttribute("lang", lang);
        model.addAttribute("theme", theme);
        return "files";
    }

    @GetMapping("/download/{filename:.+}")
    @ResponseBody
    public ResponseEntity<Resource> downloadFile(@PathVariable String filename) {

        Resource resource = storageService.loadAsResource(filename);

        return ResponseEntity.ok()
                .header(HttpHeaders.CONTENT_DISPOSITION,
                        "attachment; filename=\"" + resource.getFilename() + "\"")
                .body(resource);
    }

    @PostMapping("/upload-file")
    public String uploadFile(@RequestParam("file") MultipartFile file) {
        if (Objects.requireNonNull(file.getOriginalFilename()).endsWith(".pdf")){
            storageService.store(file);
        }
        return "redirect:/files";
    }
}