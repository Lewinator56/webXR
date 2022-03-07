# Mobile AR Requirements Specification

## Task Outline
You are required to built a Web-based AR application that displays environmental data, superimposed either on an AR marker, or a specific geolocation (lat + long) around Bangor1. The environmental data can be imaginary, presented in the form of 3D objects (bar-charts, floating panels, etc.). If you use geolocation information, it must be real, and correspond to known landmark locations (such as University locations - you may use Google Maps to obtain those)

## Requirements
- Web based augmented reality system that can display data at specific locations based on the user's location and camera direction
- built using three.JS, AFrame and PHP for the backend
- ability to track device position, pitch and yaw
- based on inputs from device, identify AR objects that are within the viewport
- Easy ability to add/edit/remove ed objects using a PHP and MySQL backend
- Extensible object architecture that does not limit use to the initial task outline

## Arcitecture Overview
![image](https://user-images.githubusercontent.com/56686419/157092676-eb616aac-11b0-4671-a7b4-5f7d8e02aff7.png)

## Application Outline
- Provide the user with a viewport that displays AR objects as positioned by the database entries in the real world. As a user moves around or rotates their device, more objects will come into the field of view. To simplify calculations, a fixed field of view of 120 degrees will be used, and an object distance limit of 200m will be enforced, objects beywond this distance will not be rendered. Information provided to the user will include details about notable locations around Bangor, such as pontio, main arts, the blob utside pontio etc... Information will be displayed as text rendered on a billboard at the POI's location or 3D models display data, such as graphs, realtime data will not be supported, at least not in regards to 3D objects.
- The ability to add objects to the database provides an extensible interface allowing users to upload extra data after the application is deployed, a bit like wikipedia. 

