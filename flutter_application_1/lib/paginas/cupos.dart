import 'dart:convert';

import 'package:flutter/material.dart';
import 'package:http/http.dart' as http;
import 'package:intl/intl.dart';

String dia = '';

class Cupos extends StatelessWidget {
  DateTime date = DateTime.now();
  String dateFormat = DateFormat('EEEE').format(DateTime.now());

  Future<List> buscaCuposPorDia() async {
    final response2 = await http.post(
        "http://192.168.43.61:8080/fta/app_flutter/getClasesReservaCupos.php",
        body: {"id_alumno": 11111111.toString(), "dia": dia.toString()});
    var jsonBody2 = response2.body;
    var jsonData2 = json.decode(jsonBody2);

    print(jsonData2);
    return jsonData2;
  }

  @override
  Widget build(BuildContext context) {
    if (dateFormat == 'Monday') {
      dia = 'Lunes';
    } else if (dateFormat == 'Tuesday') {
      dia = 'Martes';
    } else if (dateFormat == 'Wednesday') {
      dia = 'Miercoles';
    } else if (dateFormat == 'Thursday') {
      dia = 'Jueves';
    } else if (dateFormat == 'Friday') {
      dia = 'Viernes';
    } else if (dateFormat == 'Saturday') {
      dia = 'Sabado';
    } else if (dateFormat == 'Sunday') {
      dia = 'Domingo';
    }

    return new Scaffold(
        appBar: AppBar(
          title: Text("Reserva de Cupos"),
          backgroundColor: Colors.purple,
        ),
        body: new FutureBuilder<List>(
          future: buscaCuposPorDia(),
          builder: (context, snapshot) {
            if (snapshot.hasError) print(snapshot.error);
            return snapshot.hasData
                ? new Card(
                    lista: snapshot.data,
                  )
                : new Center(
                    child: new CircularProgressIndicator(),
                  );
          },
        ));
  }
}

class Card extends StatelessWidget {
  void guardarCupo() async {
    var response4 = await http.post(
        "http://192.168.43.61:8080/fta/app_flutter/gbRelacionAlumnoCupoHorario.php",
        body: {
          "id_alumno": 11111111.toString(),
          "id_curso": lista[pos]["id_curso"],
        });
  }

  final List lista;
  int pos;
  int r;
  Card(
      {this.lista,
      RoundedRectangleBorder shape,
      EdgeInsets margin,
      int elevation,
      Column child});

  @override
  Widget build(BuildContext context) {
    return new ListView.builder(
      itemCount: lista == null ? 0 : lista.length,
      itemBuilder: (context, posicion) {
        if (lista[posicion]["cupos"] != lista[posicion]["cupos_curso"]) {
          return new Container(
            padding: EdgeInsets.all(2.0),
            child: new GestureDetector(
              child: new RaisedButton(
                shape: new RoundedRectangleBorder(
                    borderRadius: BorderRadius.circular(10)),
                onPressed: () {
                  pos = posicion;
                  guardarCupo();
                  showDialog(
                      context: context,
                      builder: (BuildContext context) {
                        return AlertDialog(
                          title: Text("Reserva de cupo Correcto"),
                          actions: <Widget>[
                            FlatButton(
                              child: Text("OK"),
                              onPressed: () {
                                Navigator.push(
                                  context,
                                  MaterialPageRoute(
                                      builder: (context) => Cupos()),
                                );
                              },
                            )
                          ],
                        );
                      });
                },
                color: Colors.white,
                child: new Container(
                  padding: EdgeInsets.all(15),
                  child: Column(
                    children: <Widget>[
                      ListTile(
                        contentPadding: EdgeInsets.fromLTRB(15, 10, 25, 0),
                        title: Text(lista[posicion]["curso"]),
                        subtitle: Text(
                          lista[posicion]["profesor"] +
                              "\n" +
                              "Cupos disponibles: " +
                              lista[posicion]["disponible"],
                        ),
                        leading: Icon(
                          Icons.check,
                          color: Colors.green,
                        ),
                      ),
                      Row(
                        mainAxisAlignment: MainAxisAlignment.end,
                      )
                    ],
                  ),
                ),
              ),
            ),
          );
        } else {
          return new Container(
            padding: EdgeInsets.all(2.0),
            child: new GestureDetector(
              child: new RaisedButton(
                shape: new RoundedRectangleBorder(
                    borderRadius: BorderRadius.circular(10)),
                onPressed: () {},
                color: Colors.white,
                child: new Container(
                  padding: EdgeInsets.all(15),
                  child: Column(
                    children: <Widget>[
                      ListTile(
                        contentPadding: EdgeInsets.fromLTRB(15, 10, 25, 0),
                        title: Text(lista[posicion]["curso"]),
                        subtitle: Text(
                          lista[posicion]["profesor"] +
                              "\n" +
                              lista[posicion]["horas"],
                        ),
                        leading: Icon(
                          Icons.cancel,
                          color: Colors.red,
                        ),
                      ),
                      Row(
                        mainAxisAlignment: MainAxisAlignment.end,
                      )
                    ],
                  ),
                ),
              ),
            ),
          );
        }
      },
    );
  }
}
