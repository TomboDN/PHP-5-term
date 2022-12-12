package com.mirea.spring8.service;

import org.springframework.stereotype.Service;

import javax.imageio.ImageIO;
import java.awt.*;
import java.awt.image.BufferedImage;
import java.io.File;
import java.io.IOException;

@Service
public class WatermarkService {
    public void addImageWatermark(File watermark, String type, File source, File destination) throws IOException {
        BufferedImage image = ImageIO.read(source);
        BufferedImage overlay = ImageIO.read(watermark);

        int imageType = "png".equalsIgnoreCase(type) ? BufferedImage.TYPE_INT_ARGB : BufferedImage.TYPE_INT_RGB;
        BufferedImage watermarked = new BufferedImage(image.getWidth(), image.getHeight(), imageType);

        Graphics2D w = (Graphics2D) watermarked.getGraphics();
        w.drawImage(image, 0, 0, null);
        AlphaComposite alphaChannel = AlphaComposite.getInstance(AlphaComposite.SRC_OVER, 0.4f);
        w.setComposite(alphaChannel);

        int posX = image.getWidth() - overlay.getWidth();
        int posY = image.getHeight() - overlay.getHeight();

        w.drawImage(overlay, posX, posY, null);
        ImageIO.write(watermarked, type, destination);
        w.dispose();
    }
}
