package com.mirea.spring8.response;

import lombok.Getter;
import lombok.Setter;

import java.io.Serializable;

@Setter
@Getter
public class FileResponse implements Serializable {
    private String name;
    private String uri;
    private String type;
    private long size;

    public FileResponse(String name, String uri, String type, long size) {
        this.name = name;
        this.uri = uri;
        this.type = type;
        this.size = size;
    }
}
