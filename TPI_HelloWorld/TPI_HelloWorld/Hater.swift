//
//  Hater.swift
//  TPI_HelloWorld
//
//  Created by Info on 03.02.23.
//

import Foundation

struct Hater{
    
    var hating = false
    
    mutating func hadABadDay(){
        hating = true
    }
    
    mutating func hadAGoodDay(){
        hating = false
    }
}
