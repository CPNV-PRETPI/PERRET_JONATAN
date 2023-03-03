//
//  HomePage.swift
//  FitFocus
//
//  Created by Info on 02.03.23.
//

import SwiftUI

struct HomePage: View {
    
    var body: some View {
        ZStack(alignment: .center) {
            Spacer()
            ZStack(alignment: .topLeading){
                /*Text(settings.userName).font(.largeTitle).foregroundColor(Color.white)*/
                Spacer()
            }
            VStack(){
                Text("FIT FOCUSSSSS").font(.largeTitle).foregroundColor(Color.white)
                Spacer()
            }
            HStack(alignment: .center, spacing: 15){
                Spacer()
                Spacer()
            }.padding([.leading, .trailing], 27.5)
            Spacer()
        }
        .padding().background(LinearGradient(gradient: Gradient(colors: [.orange, .red]), startPoint: .top, endPoint: .bottom).edgesIgnoringSafeArea(.all))
    }
}

struct HomePage_Previews: PreviewProvider {
    static var previews: some View {
        HomePage()
    }
}
