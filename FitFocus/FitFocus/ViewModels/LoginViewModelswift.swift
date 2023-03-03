//
//  LoginViewModelswift.swift
//  FitFocus
//
//  Created by Info on 03.03.23.
//

import Foundation
import Alamofire

class LoginViewModel: ObservableObject {
  @Published var secureString: String = ""
  @Published var createLoginResponse: CreateLoginResponse?
    
func createLogin(request: CreateLoginRequest) {
    APIServices.shared.callCreateLogin(parameters: request.dictionary ?? [:]) { response in
      if let response = response {
        print(response)
      }
    }
      failure: { error in
        print(error)
      }
  }
}
