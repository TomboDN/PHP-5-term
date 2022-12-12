package com.mirea.spring8.model;

import jakarta.persistence.Entity;
import jakarta.persistence.GeneratedValue;
import jakarta.persistence.Id;
import jakarta.persistence.Table;
import lombok.Getter;
import lombok.Setter;

import java.io.Serializable;
import java.time.Instant;

@Entity
@Setter
@Getter
@Table(name = "products")
public class Product implements Serializable {
    @Id
    @GeneratedValue
    private int id;
    private String name;
    private String volume;
    private String description;
    private int price;
    private Instant created;
}
