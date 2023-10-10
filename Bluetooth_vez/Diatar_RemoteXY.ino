/*
   -- ESP32_RemoteXY_DIATAR --
   
   This source code of graphical user interface 
   has been generated automatically by RemoteXY editor.
   To compile this code using RemoteXY library 3.1.8 or later version 
   download by link http://remotexy.com/en/library/
   To connect using RemoteXY mobile app by link http://remotexy.com/en/download/                   
     - for ANDROID 4.11.1 or later version;
     - for iOS 1.9.1 or later version;
    
   This source code is free software; you can redistribute it and/or
   modify it under the terms of the GNU Lesser General Public
   License as published by the Free Software Foundation; either
   version 2.1 of the License, or (at your option) any later version.    
*/

// TFT initialize
#include <TFT_eSPI.h>
TFT_eSPI tft = TFT_eSPI();
const int pwmFreq = 5000;
const int pwmResolution = 8;
const int pwmLedChannelTFT = 0;
int backlight[5] = {10,30,60,120,220};
byte b=1;

//////////////////////////////////////////////
//        RemoteXY include library          //
//////////////////////////////////////////////

// RemoteXY select connection mode and include library 
#define REMOTEXY_MODE__ESP32CORE_BLE
#include <BLEDevice.h>

#include <RemoteXY.h>

// RemoteXY connection settings 
#define REMOTEXY_BLUETOOTH_NAME "Diatar_RemoteXY"
#define REMOTEXY_ACCESS_PASSWORD "8934"


// RemoteXY configurate  
#pragma pack(push, 1)
uint8_t RemoteXY_CONF[] =   // 84 bytes
  { 255,4,0,0,0,77,0,16,177,1,1,0,36,5,19,19,6,31,69,76,
  197,144,82,69,0,1,0,7,5,19,19,6,31,86,73,83,83,90,65,0,
  1,0,20,37,22,22,6,31,86,69,84,195,141,84,195,137,83,0,1,2,
  9,75,46,14,6,31,75,195,182,118,101,116,107,101,122,197,145,32,195,169,
  110,101,107,0 };
  
// this structure defines all the variables and events of your control interface 
struct {

    // input variables
  uint8_t button_1; // =1 if button pressed, else =0 
  uint8_t button_2; // =1 if button pressed, else =0 
  uint8_t button_3; // =1 if button pressed, else =0 
  uint8_t button_4; // =1 if button pressed, else =0 

    // other variable
  uint8_t connect_flag;  // =1 if wire connected, else =0 

} RemoteXY;
#pragma pack(pop)


/////////////////////////////////////////////
//           END RemoteXY include          //
/////////////////////////////////////////////


#define PIN_BUTTON_1 21 //NEXT
#define PIN_BUTTON_2 22 //BACK
#define PIN_BUTTON_3 17 //ON
#define PIN_BUTTON_4 15 //FORWARD


char incomingByte[4]; // for incoming serial data
byte c_b;
char comm;
int comm2;
int comm3;


void setup() 
{
  RemoteXY_Init (); 

/* OUTPUTS
  pinMode (PIN_BUTTON_1, OUTPUT);
  pinMode (PIN_BUTTON_2, OUTPUT);
  pinMode (PIN_BUTTON_3, OUTPUT);
  pinMode (PIN_BUTTON_4, OUTPUT);
*/

  // TODO you setup code

  Serial.begin(2400);
  
  tft.init();
  tft.setRotation(0);
  tft.fillScreen(TFT_BLUE);
  tft.setTextColor(TFT_WHITE,TFT_BLACK);  tft.setTextSize(1);
  ledcSetup(pwmLedChannelTFT, pwmFreq, pwmResolution);
  ledcAttachPin(TFT_BL, pwmLedChannelTFT);
  ledcWrite(pwmLedChannelTFT, backlight[b]);
   
}

void loop() 
{ 
  RemoteXY_Handler ();

/* OUTPUTS
  digitalWrite(PIN_BUTTON_1, (RemoteXY.button_1==0)?LOW:HIGH);
  digitalWrite(PIN_BUTTON_2, (RemoteXY.button_2==0)?LOW:HIGH);
  digitalWrite(PIN_BUTTON_3, (RemoteXY.button_3==0)?LOW:HIGH);
  digitalWrite(PIN_BUTTON_4, (RemoteXY.button_4==0)?LOW:HIGH);
*/

  // TODO you loop code
  // use the RemoteXY structure for data transfer
  // do not call delay() 

  c_b = 128;

  if (RemoteXY.button_1==1)
  {
    c_b = 8;
  }
  
  if (RemoteXY.button_2==1)
  {
    c_b = 4;
  }
  
  if (RemoteXY.button_3==1)
  {
    c_b = 2;
  }
  else

  if (RemoteXY.button_4==1)
  {
    c_b = 1;
  }

  if (comm == 1)
      {
      tft.setTextColor(TFT_GREEN, TFT_BLUE);
      tft.drawString("CONN. OK", 5, 200, 4);
      c_b = 128;
      comm = 0;
      comm2 = 0;
      comm3 = comm3 + 1;
      }
      else
      {
      comm2 = comm2 + 1;
      comm3 = 0;
      }

  if (comm2 > 100)
  {
      tft.setTextColor(TFT_RED, TFT_BLUE);
      tft.drawString("CONN. NO", 5, 200, 4);
  }
  
    tft.setTextColor(TFT_WHITE, TFT_BLUE);
    tft.drawString("DIATAR", 22, 5, 4);
    tft.drawString("REMOTE", 18, 40, 4);
    tft.drawString("CONTROL", 7, 78, 4);
    tft.drawString("CODE:", 30, 120, 4);
    tft.drawString(REMOTEXY_ACCESS_PASSWORD, 40, 145, 4);
    
  if (Serial.available() > 0) {
    Serial.readBytes(incomingByte, 3);
    //tft.drawString(incomingByte, 10, 200, 4);
    if ((incomingByte[0] == 68) & (incomingByte[1] == 73) & (incomingByte[2] == 68))
    {
    comm = 1;
    Serial.write(c_b);
    Serial.write(0);
    Serial.write(c_b);
    incomingByte[0] = 0;
    incomingByte[1] = 0;
    incomingByte[2] = 0;
    }
    }
}
