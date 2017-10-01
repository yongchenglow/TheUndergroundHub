#include <Arduino.h>
#include <avr/io.h>
#include <Arduino_FreeRTOS.h>
#include <task.h>
#include <semphr.h>
#include <queue.h>
#include <stdio.h>
#include <stdlib.h>

#define STACK_SIZE    200

SemaphoreHandle_t semaphore = xSemaphoreCreateBinary();

/* LED */
int LED = 12;

/* Metal Touch Sensor */
const int metalTouchSensor = 7;
const int analogInMetalTouchSensor = A0;
const int metalTouchSensorLED = 13;
int metalTouchSensorState = 0; 
int metalTouchSensorValue = 0;

/* Photo Resistor Module */
int photoResistor = A1;
int photoResistorValue = 0;

/* Motor Pins */
int motorPin1 = 8; 
int motorPin2 = 9; 
int motorPin3 = 10; 
int motorPin4 = 11; 
int motorStep = 0; 
boolean motorDirection = false;// false=clockwise, true=counter clockwise

/** 
 *  Function to turn the Rotor
 *  True for Clockwise
 *  False for Anti-CLockwise
 */
void turnRotor(){
    for(int count = 0; count < 1024; count++)
      rotateRotor();
    
    motorDirection = !motorDirection;
    for(int count = 0; count < 1024; count++)
      rotateRotor();
}

/** 
 *  Function to rotate the Rotor
 *  Each rotation is 45 degress
 */
void rotateRotor(){
   switch(motorStep){ 
   case 0: 
     digitalWrite(motorPin1, LOW);  
     digitalWrite(motorPin2, LOW); 
     digitalWrite(motorPin3, LOW); 
     digitalWrite(motorPin4, HIGH); 
   break;  
   case 1: 
     digitalWrite(motorPin1, LOW);  
     digitalWrite(motorPin2, LOW); 
     digitalWrite(motorPin3, HIGH); 
     digitalWrite(motorPin4, HIGH); 
   break;  
   case 2: 
     digitalWrite(motorPin1, LOW);  
     digitalWrite(motorPin2, LOW); 
     digitalWrite(motorPin3, HIGH); 
     digitalWrite(motorPin4, LOW); 
   break;  
   case 3: 
     digitalWrite(motorPin1, LOW);  
     digitalWrite(motorPin2, HIGH); 
     digitalWrite(motorPin3, HIGH); 
     digitalWrite(motorPin4, LOW); 
   break;  
   case 4: 
     digitalWrite(motorPin1, LOW);  
     digitalWrite(motorPin2, HIGH); 
     digitalWrite(motorPin3, LOW); 
     digitalWrite(motorPin4, LOW); 
   break;  
   case 5: 
     digitalWrite(motorPin1, HIGH);  
     digitalWrite(motorPin2, HIGH); 
     digitalWrite(motorPin3, LOW); 
     digitalWrite(motorPin4, LOW); 
   break;  
   case 6: 
     digitalWrite(motorPin1, HIGH);  
     digitalWrite(motorPin2, LOW); 
     digitalWrite(motorPin3, LOW); 
     digitalWrite(motorPin4, LOW); 
   break;  
   case 7: 
     digitalWrite(motorPin1, HIGH);  
     digitalWrite(motorPin2, LOW); 
     digitalWrite(motorPin3, LOW); 
     digitalWrite(motorPin4, HIGH); 
   break;  
   default: 
     digitalWrite(motorPin1, LOW);  
     digitalWrite(motorPin2, LOW); 
     digitalWrite(motorPin3, LOW); 
     digitalWrite(motorPin4, LOW); 
   break;  
 }
 if(motorDirection == true){ 
   motorStep++; 
 }else{ 
   motorStep--; 
 } 
 if(motorStep>7){ 
   motorStep=0; 
 } 
 if(motorStep<0){ 
   motorStep=7; 
 }
 delay(1);
}

void setup(){
  pinMode(metalTouchSensor,INPUT);
  pinMode(metalTouchSensorLED,OUTPUT);
  pinMode(LED,OUTPUT);  
  pinMode(motorPin1, OUTPUT);  
  pinMode(motorPin2, OUTPUT);  
  pinMode(motorPin3, OUTPUT);  
  pinMode(motorPin4, OUTPUT);
  digitalWrite(LED, HIGH);
  Serial.begin (115200);  
}

void loop(){
  // Read Photo Resistor Value
  photoResistorValue = analogRead(photoResistor);
  //Serial.println (photoResistorValue);

  // If Low light is detected
  if(photoResistorValue > 512){
    for(int i = 0; i < 500; i++){
      if(digitalRead(metalTouchSensor) == 1){
        metalTouchSensorState = 1;
      }
      if(metalTouchSensorState == 1)
        digitalWrite(metalTouchSensorLED, HIGH);
      else
        digitalWrite(metalTouchSensorLED, LOW);
      delay(10);
    }

    // Check the State of the Metal Detector
    //metalTouchSensorState = digitalRead(metalTouchSensor);

    if(metalTouchSensorState == 1)
      motorDirection = true; // Turn Clockwise 1 round
    else
      motorDirection = false; // Turn AntiClockwise 1 round
      
    turnRotor();

    metalTouchSensorState = 0;
    /* For Debugging Purpose */
    //metalTouchSensorValue = analogRead (analogInMetalTouchSensor);
    //Serial.println (metalTouchSensorValue);
    //Serial.println (photoResisitorValue);
    //if(metalTouchSensorState == HIGH)
    //  digitalWrite(metalTouchSensorLED, HIGH);
    //else
    //  digitalWrite(metalTouchSensorLED, LOW);
  } else {
    // Do nothing
  }
    
}
