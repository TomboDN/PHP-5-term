package com.mirea.spring8.response;

import lombok.Getter;
import lombok.Setter;
import lombok.ToString;

import java.io.Serializable;
@Setter
@Getter
@ToString
public class CookieResponse implements Serializable {
    private String theme;
    private String lang;
}
