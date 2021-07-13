#include <Servo.h>

Servo hand,wrist,elbow,shoulder,waist;

void setup() {
  // put your setup code here, to run once:
  hand.attach(7);
  wrist.attach(6);
  elbow.attach(5);
  shoulder.attach(4);

}

void loop() {
  // put your main code here, to run repeatedly:
  int an=0;
  int SA=0;
  int i=0;
  int a=0,b=0,c=0,d=0;

  SA=Serial.available();
  if(SA>0){
    char buf=Serial.read();
    while(buf!='X'){
     switch(buf){
       case 'A':
         a=readnum();
         break;
       case 'B':
         b=readnum();
         break;
       case 'C':
         c=readnum();
         break;
       case 'D':
         d=readnum();
         break;
       default:
         break;
     }
     
     hand.write(a);
     wrist.write(b);
     elbow.write(c);
     shoulder.write(d);

     Serial.print(a);
     
     buf=Serial.read();
    }
  }
}

int readnum(){
  int an=0,i=0;
  char buf=Serial.read();
  while(true){
    i=buf-48;
    an=an+i;
    delay(10);
    buf=Serial.read();
    if(buf=='F'){
      break;
    }
    an*=10;
  }
  return i;
}