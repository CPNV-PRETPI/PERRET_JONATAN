//
//  ContentView.swift
//  TPI_HelloWorld
//
//  Created by Info on 03.02.23.
//

import SwiftUI

struct ContentView: View {
    var text = "Hello world !"
    var body: some View {
        HStack {
            Image(systemName: "circle.fill")
                .imageScale(.large)
                .foregroundColor(.accentColor)
            Text(text)
        }
        .padding()
    }
}

struct ContentView_Previews: PreviewProvider {
    static var previews: some View {
        ContentView()
    }
}
