//
//  JsonModels.swift
//  FitFocus
//
//  Created by Info on 03.03.23.
//

import Foundation
import Alamofire

// Request login
struct CreateLoginRequest: Codable{
    var secure_string: String?
}

// response login
struct CreateLoginResponse: Codable{
    var token: String
}

struct APIServices {
  public static let shared = APIServices()
  func callCreateLogin(parameters: Parameters? = nil, success: @escaping (_ result: CreateLoginResponse?) -> Void, failure: @escaping (_ failureMsg: FailureMessage) -> Void) {
    var headers = HTTPHeaders()
    headers["content-type"] = "application/json"
    FitFocusApi.shared.callAPI(serverURL: "http://localhost:8080", method: .post, headers: headers, parameters: parameters, success: { response in
      do {
        if let data = response.data {
          let createLoginResponse = try JSONDecoder().decode(CreateLoginResponse.self, from: data)
          success(createLoginResponse)
        }
      } catch {
        failure(FailureMessage(error.localizedDescription))
      }
    }, failure: { error in
      failure(FailureMessage(error))
    })
  }
}
