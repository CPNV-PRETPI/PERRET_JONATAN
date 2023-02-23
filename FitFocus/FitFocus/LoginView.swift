//
//  ContentView.swift
//  FitFocus
//
//  Created by Info on 20.02.23.
//

import SwiftUI
import AVFoundation
import CodeScanner


struct LoginView: View {
    @State private var _security_string = ""
    
    var body: some View {
        VStack {
            Spacer()
            Text("FIT FOCUS").font(.largeTitle).foregroundColor(Color.white).padding([.top, .bottom], 40)
            CodeScannerView(codeTypes: [.qr], simulatedData: "Paul Hudson") { response in
                switch response {
                case .success(let result):
                    print("Found code: \(result.string)")
                    // decode the string from qr code
                    var url = URL(string: "http://localhost:8000?apimethod=ping")
                    
                    
                    // Call the function to request the authentication
                    PostRequest(url: url!, parameters: [result.string: result.string])
                case .failure(let error):
                    print(error.localizedDescription)
                }
            }.frame(width: 250, height: 250).clipShape(Rectangle()).overlay(Rectangle().stroke(Color.white, lineWidth: 4)).shadow(radius: 10).padding(.bottom, 50)
            VStack(alignment: .leading, spacing: 15){
                TextField("security string", text: self.$_security_string).padding().cornerRadius(20.0)
            }.padding([.leading, .trailing], 27.5)
            Button(action:{}){
                Text("Sign In").font(.headline).foregroundColor(.white).frame(width: 300, height: 50).background(Color.green).cornerRadius(15.0)
                
            }
            Spacer()
        }
        .padding().background(LinearGradient(gradient: Gradient(colors: [.orange, .red]), startPoint: .top, endPoint: .bottom).edgesIgnoringSafeArea(.all))
    }
    
    
}

extension Dictionary {
    func percentEncoded() -> Data? {
        map { key, value in
            let escapedKey = "\(key)".addingPercentEncoding(withAllowedCharacters: .urlQueryValueAllowed) ?? ""
            let escapedValue = "\(value)".addingPercentEncoding(withAllowedCharacters: .urlQueryValueAllowed) ?? ""
            return escapedKey + "=" + escapedValue
        }
        .joined(separator: "&")
        .data(using: .utf8)
    }
}

extension CharacterSet {
    static let urlQueryValueAllowed: CharacterSet = {
        let generalDelimitersToEncode = ":#[]@" // does not include "?" or "/" due to RFC 3986 - Section 3.4
        let subDelimitersToEncode = "!$&'()*+,;="
        
        var allowed: CharacterSet = .urlQueryAllowed
        allowed.remove(charactersIn: "\(generalDelimitersToEncode)\(subDelimitersToEncode)")
        return allowed
    }()
}

struct ContentView_Previews: PreviewProvider {
    static var previews: some View {
        LoginView()
    }
}
