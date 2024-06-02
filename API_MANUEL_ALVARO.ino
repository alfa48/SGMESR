#include <ArduinoJson.h>
#include <WiFi.h>
#include <WebServer.h>

/* Put your SSID & Password */
const char* ssid = "ESP32";  // Enter SSID here
const char* password = "12345678";  //Enter Password here

/* Put IP Address details */
IPAddress local_ip(192,168,1,1);
IPAddress gateway(192,168,1,1);
IPAddress subnet(255,255,255,0);

WebServer server(80);

uint8_t LED1pin = 4;
bool LED1status = LOW;

uint8_t LED2pin = 5;
bool LED2status = LOW;

uint8_t LED3pin = 2;
bool LEDYellowStatus = LOW;

const int sensorPin = 34;  // Pino analógico do ESP32 conectado ao sensor de tensão da bateria
float voltage = 0;

const int sensorPinPainel = 34;  // Pino analógico do ESP32 conectado ao sensor de tensão do painel
float voltagePainel = 0;

const int buzzerPin = 8;  // Pino digital do ESP32 conectado ao buzzer
bool buzzerStatus = LOW;

void setup() {
  Serial.begin(115200);

/*
 * JSON

  const char* json = "{\"sensor\":\"temperatura\",\"valor\":23.5}";
   // Parseia a string JSON
  DeserializationError error = deserializeJson(doc, json);
// Verifica se houve erro ao parsear
  if (error) {
    Serial.print(F("Falha ao parsear JSON: "));
    Serial.println(error.f_str());
    return;
  }


  serializeJson(doc, outputJsonString);
  // Acessa os valores
  const char* sensor = doc["sensor"];
  float valor = doc["valor"];
*/

  pinMode(LED1pin, OUTPUT);
  pinMode(LED2pin, OUTPUT);
  pinMode(LED3pin, OUTPUT);// Define o pino do LED como saida
  pinMode(sensorPin, INPUT); // Define o pino do sensor como entrada
  pinMode(sensorPinPainel, INPUT); // Define o pino do sensor de tensao do painel como entrada
  pinMode(buzzerPin, OUTPUT);// Define o pino buzzer como saida

  WiFi.softAP(ssid, password);
  WiFi.softAPConfig(local_ip, gateway, subnet);
  delay(100);

  server.on("/", handle_OnConnect);
  server.on("/swhich_led1", handle_swhichLED1);
  server.on("/swhich_led2", handle_swhichLED2);
  server.on("/led1on", handle_led1on);
  server.on("/led1off", handle_led1off);
  server.on("/led2on", handle_led2on);
  server.on("/led2off", handle_led2off);
  server.on("/put_tensao", handle_putTensao);
  server.on("/put_tensaoPainel", handle_putTensaoPainel);
  server.on("/setOn_buzzer", handle_setOnBuzzer);
  server.on("/setOff_buzzer", handle_setOffBuzzer);

  server.on("/offledYellow", handle_OffLEDYellow);
  server.on("/onledYellow", handle_OnLEDYellow);
  //server.on("/put_tensao_bateria", handle_putTensaoBateria);
  //server.on("/put_tensao_painel", handle_putTensaoPainel);
  server.onNotFound(handle_NotFound);

  server.begin();
  Serial.println("HTTP server started");
}
void loop() {
  server.handleClient();

    int sensorValue = analogRead(sensorPin);
    voltage = sensorValue * (25.0 / 4095.0);  // Convertendo o valor lido para a tensão (0-25V)

    int sensorValuePainel = analogRead(sensorPinPainel);
    voltagePainel = sensorValuePainel * (25.0 / 4095.0);  // Convertendo o valor lido para a tensão (0-25V)


  if(LED1status)
  {digitalWrite(LED1pin, HIGH);}
  else
  {digitalWrite(LED1pin, LOW);}

  if(LED2status)
  {digitalWrite(LED2pin, HIGH);}
  else
  {digitalWrite(LED2pin, LOW);}

//AQUI LED YELLOW
  if(LEDYellowStatus)
  {digitalWrite(LED3pin, HIGH);}
  else
  {digitalWrite(LED3pin, LOW);}

  //AQUI BUZZER
  if(buzzerStatus)
  {digitalWrite(buzzerPin, HIGH);}
  else
  {digitalWrite(buzzerPin, LOW);}
}

void handle_OnConnect() {
  LED1status = LOW;
  LED2status = LOW;
  LEDYellowStatus = LOW;
  buzzerStatus = LOW;
  Serial.println("GPIO4 Status: OFF | GPIO5 Status: OFF");
  server.send(200, "text/html", SendHTML(false, LED1status, LED2status));
}

void handle_led1on() {
  LED1status = HIGH;
  Serial.println("GPIO4 Status: ON");
  server.send(200, "text/html", SendHTML(true, LED1status, LED2status));
}

void handle_led1off() {
  LED1status = LOW;
  Serial.println("GPIO4 Status: OFF");
  server.send(200, "text/html", SendHTML(true, LED1status, LED2status));
}

void handle_led2on() {
  LED2status = HIGH;
  Serial.println("GPIO5 Status: ON");
  server.send(200, "text/html", SendHTML(false, LED1status, LED2status));
}

void handle_led2off() {
  LED2status = LOW;
  Serial.println("GPIO5 Status: OFF");
  server.send(200, "text/html", SendHTML(false, LED1status, LED2status));
}

void handle_putTensao() {
  Serial.println("Status: enviar dados do sensor de tensao");

  // Cria um documento JSON
  StaticJsonDocument<200> doc;
  doc["sensor"] = "tensao bateria";
  doc["valor"] = voltage;

  // Serializa o documento JSON para uma string
  String output;
  serializeJson(doc, output);

  server.send(200, "application/json", output);
}

void handle_putTensaoPainel(){
  Serial.println("Status: enviar dados do sensor de tensao do painel");

  // Cria um documento JSON
  StaticJsonDocument<200> doc;
  doc["sensor"] = "tensao painel";
  doc["valor"] = voltagePainel;

  // Serializa o documento JSON para uma string
  String output;
  serializeJson(doc, output);

  server.send(200, "application/json", output);
}

void handle_NotFound(){
  server.send(404, "text/plain", "estás no SGESR ... \n O dev é muito preguiçoso para fazer essa página!");
}

void handle_swhichLED1(){
   if (LED1status == LOW)
          LED1status = HIGH;
   else
          LED1status = LOW;
   server.send(200, "application/json", getJSONDone());
}
void handle_swhichLED2(){
   if (LED2status == LOW)
          LED2status = HIGH;
   else
          LED2status = LOW;
   server.send(200, "application/json", getJSONDone());
}

void handle_OnLEDYellow(){
        LEDYellowStatus = HIGH;
   server.send(200, "application/json", getJSONDone());
}
void handle_OffLEDYellow(){
        LEDYellowStatus = LOW;
   server.send(200, "application/json", getJSONDone());
}
//AQUI

void handle_setOnBuzzer(){
        buzzerStatus = HIGH;
   server.send(200, "application/json", getJSONDone());
}
void handle_setOffBuzzer(){
        buzzerStatus = LOW;
   server.send(200, "application/json", getJSONDone());
}

String SendHTML(uint8_t tensaoDeEntrada, uint8_t led1stat, uint8_t led2stat){
  return "a ser feito ...";
}
/*
 * Metodos Utils
*/
String getJSONDone()
{
    // Cria um documento JSON
  StaticJsonDocument<200> doc;

  String outputJsonString;
  const char* json = "{\"status\":\"OK\"}";
   // Parseia a string JSON
  DeserializationError error = deserializeJson(doc, json);
// Verifica se houve erro ao parsear
  if (error) {
    Serial.print(F("Falha ao parsear JSON: "));
    Serial.println(error.f_str());
    return ("ERRO");
  }
  serializeJson(doc, outputJsonString);
  return (outputJsonString);
 }

 String getJSONERRO()
{
    StaticJsonDocument<200> doc;
  String outputJsonString;
  const char* json = "{\"status\":\"OFF\"}";
   // Parseia a string JSON
  DeserializationError error = deserializeJson(doc, json);
// Verifica se houve erro ao parsear
  if (error) {
    Serial.print(F("Falha ao parsear JSON: "));
    Serial.println(error.f_str());
    return ("ERRO");
  }
  serializeJson(doc, outputJsonString);
  return (outputJsonString);
 }
