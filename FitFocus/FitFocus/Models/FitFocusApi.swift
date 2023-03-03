import Alamofire
import Foundation
public typealias FailureMessage = String

public class FitFocusApi {
  public static let shared = FitFocusApi()
  
  func callAPI(serverURL: String, method: HTTPMethod = .get, headers: HTTPHeaders? = nil, parameters: Parameters? = nil, success: @escaping ((AFDataResponse<Any>) -> Void), failure: @escaping ((FailureMessage) -> Void)) {
    
    guard var url = URLComponents(string: "\(serverURL)") else {
      failure("Invalid URL")
      return
    }
    // Network request
    AF.request(url, method: method, parameters: parameters, encoding: JSONEncoding.default, headers: headers)
      .responseJSON { response in
        switch response.result {
        case .success:
          success(response)
        case let .failure(error):
          failure(error.localizedDescription)
        }
      }
  }
}
