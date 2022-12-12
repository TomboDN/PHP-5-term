package com.mirea.spring8.repository;

import com.mirea.spring8.model.Product;
import org.springframework.data.jpa.repository.JpaRepository;

public interface ProductRepository extends JpaRepository<Product, Integer> {
}
