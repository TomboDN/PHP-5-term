package com.mirea.spring8.model;

import jakarta.persistence.Entity;
import jakarta.persistence.GeneratedValue;
import jakarta.persistence.Id;
import jakarta.persistence.Table;
import lombok.Getter;
import lombok.Setter;

import java.io.Serializable;

@Entity
@Setter
@Getter
@Table(name = "users")
public class User implements Serializable {
    @Id
    @GeneratedValue
    private int id;
    private String name;
    private String password;
    private String role;

}
