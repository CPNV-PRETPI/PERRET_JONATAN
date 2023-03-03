//
//  ContentView.swift
//  FitFocus
//
//  Created by Info on 20.02.23.
//

import SwiftUI
import AVFoundation
import CodeScanner


struct LoginPage: View {
    @EnvironmentObject var vm: UserStateViewModel
    @StateObject var loginViewModel = LoginViewModel()
    
    fileprivate func QrCodeScanner(){
        CodeScannerView(codeTypes: [.qr], simulatedData: "Paul Hudson") { response in
            switch response {
            case .success(let result):
                print("Found code: \(result.string)")
                // decode the string from qr code
                var url = URL(string: "http://10.0.0.1:8000/?apimethod=ping")
                
                // Call the function to request the authentication
                /*var result : JSON = PostRequest(url: url!, parameters: [result.string: result.string])
                print(result)*/
            case .failure(let error):
                print(error.localizedDescription)
            }
        }.frame(width: 250, height: 250).clipShape(Rectangle()).overlay(Rectangle().stroke(Color.white, lineWidth: 4)).shadow(radius: 10).padding(.bottom, 50)
    }
    
    
    var body: some View {
        NavigationView(){
            VStack {
                Spacer()
                Text("FIT FOCUS").font(.largeTitle).foregroundColor(Color.white).padding([.top, .bottom], 40)
                
                HStack(alignment: .center, spacing: 15){
                    Spacer()
                    TextField("security string", text: self.$loginViewModel.secureString).padding().cornerRadius(20.0).frame(maxWidth: 300)
                    Spacer()
                }.padding([.leading, .trailing], 27.5)
                Button(action:{
                    Task{
                        let createLoginRequest = CreateLoginRequest(secure_string: self.loginViewModel.secureString)
                        loginViewModel.createLogin(request: createLoginRequest)
                    }
                }){
                    Text("Sign In").font(.headline).foregroundColor(.white).frame(width: 300, height: 50).background(Color.green).cornerRadius(15.0)
                }
                Spacer()
            }
            .padding().background(LinearGradient(gradient: Gradient(colors: [.orange, .red]), startPoint: .top, endPoint: .bottom).edgesIgnoringSafeArea(.all))
        }
    }
    
}

struct ContentView_Previews: PreviewProvider {
    static var previews: some View {
        LoginPage()
    }
}
