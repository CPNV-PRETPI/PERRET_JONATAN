//
//  FitFocusApi.swift
//  FitFocus
//
//  Created by Info on 23.02.23.
//

import Foundation

func PostRequest(url : URL, parameters : [String: Any]) {
  
  // create the session object
  let session = URLSession.shared
  
  // now create the URLRequest object using the url object
  var request = URLRequest(url: url)
  request.httpMethod = "POST" //set http method as POST
  
  // add headers for the request
  request.addValue("application/json", forHTTPHeaderField: "Content-Type") // change as per server requirements
  request.addValue("application/json", forHTTPHeaderField: "Accept")
  
  do {
    // convert parameters to Data and assign dictionary to httpBody of request
    request.httpBody = try JSONSerialization.data(withJSONObject: parameters, options: .prettyPrinted)
  } catch let error {
    print(error.localizedDescription)
    return
  }
  
  // create dataTask using the session object to send data to the server
  let task = session.dataTask(with: request) { data, response, error in
    
    if let error = error {
      print("Post Request Error: \(error.localizedDescription)")
      return
    }
    
    // ensure there is valid response code returned from this HTTP response
    guard let httpResponse = response as? HTTPURLResponse,
          (200...299).contains(httpResponse.statusCode)
    else {
      print("Invalid Response received from the server")
      return
    }
    
    // ensure there is data returned
    guard let responseData = data else {
      print("nil Data received from the server")
      return
    }
    
    do {
      // create json object from data or use JSONDecoder to convert to Model stuct
      if let jsonResponse = try JSONSerialization.jsonObject(with: responseData, options: []) as? [String: Any] {
        print(jsonResponse)
        // handle json response
      } else {
        print("data maybe corrupted or in wrong format")
        throw URLError(.badServerResponse)
      }
    } catch let error {
      print(error)
    }
  }
  // perform the task
  task.resume()
}
