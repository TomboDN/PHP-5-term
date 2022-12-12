package com.mirea.spring8;

import com.mirea.spring8.config.StorageProperties;
import org.springframework.boot.SpringApplication;
import org.springframework.boot.autoconfigure.SpringBootApplication;
import org.springframework.boot.context.properties.EnableConfigurationProperties;

@SpringBootApplication
@EnableConfigurationProperties(StorageProperties.class)
public class Spring8Application {

	public static void main(String[] args) {
		SpringApplication.run(Spring8Application.class, args);
	}

}
