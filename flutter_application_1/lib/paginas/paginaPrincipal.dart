import 'package:flutter/material.dart';

class Principal extends StatelessWidget {
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: new AppBar(
        title: Text('Pagina Principal'),
      ),
      body: new Column(
        children: <Widget>[
          new Text('Estamos en Principal'),
          RaisedButton(
            child: Text("Salir"),
            onPressed: () {
              Navigator.pushReplacementNamed(context, '/MyApp');
            },
          )
        ],
      ),
    );
  }
}
