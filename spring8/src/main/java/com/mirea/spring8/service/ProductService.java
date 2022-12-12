package com.mirea.spring8.service;

import com.mirea.spring8.model.Product;
import com.mirea.spring8.model.User;
import com.mirea.spring8.repository.ProductRepository;
import lombok.RequiredArgsConstructor;
import org.springframework.stereotype.Service;

import java.util.List;
import java.util.Optional;

@Service
@RequiredArgsConstructor
public class ProductService {
    private final ProductRepository productRepository;

    public List<Product> findAll(){
        return productRepository.findAll();
    }
    public Optional<Product> findById(int id){
        return productRepository.findById(id);
    }
    public Product save(Product product){
        productRepository.save(product);
        return product;
    }
    public void deleteById(int id){
        productRepository.deleteById(id);
    }
}
