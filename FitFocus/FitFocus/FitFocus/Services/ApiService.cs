using System;
using System.Collections.Generic;
using System.IO;
using System.Net;
using System.Net.Http;
using Newtonsoft.Json;
using System.Security.Cryptography.X509Certificates;

namespace FitFocus.Services
{
	public static class ApiService
	{
        public static string GetUrl()
        {
            return "https://fitfocus.cld.education";
        }

        /// <summary>
        /// Send an authentification request
        /// </summary>
        /// <param name="Url">url to connect</param>
        /// <param name="securityString">secure string of the user</param>
        /// <returns>response from the server</returns>
        public static string PostToAPIEndpoint_Authentify(string securityString)
        {
            string Url = GetUrl() + "?apimethod=authenticate";
            string html = string.Empty;
            Dictionary<string, string> body = new Dictionary<string, string>();
            body.Add("security-string", securityString);
            return PostToAPIEndpoint(body, Url);
        }



        /// <summary>
        /// Work around the ssl certificate in debug mode
        /// </summary>
        /// <param name="sender"></param>
        /// <param name="certification"></param>
        /// <param name="chain"></param>
        /// <param name="sslPolicyErrors"></param>
        /// <returns></returns>
        private static bool AcceptAllCertifications(object sender, X509Certificate certification, X509Chain chain, System.Net.Security.SslPolicyErrors sslPolicyErrors)
        {
            return true;
        }


        /// <summary>
        /// Make an API request to the url passed with the html passed
        /// </summary>
        /// <param name="body">html to send to server</param>
        /// <param name="Url">url to send the request</param>
        /// <returns>response from the server</returns>
        public static string PostToAPIEndpoint(Dictionary<string, string> body, string Url)
        {
            using (var client = new HttpClient())
            {
                var httpWebRequest = (HttpWebRequest)WebRequest.Create(Url);
                httpWebRequest.ContentType = "application/x-www-form-urlencoded";
                httpWebRequest.Method = "POST";
                //skip the ssl certificates
                ServicePointManager.ServerCertificateValidationCallback = new System.Net.Security.RemoteCertificateValidationCallback(AcceptAllCertifications);
                string json = JsonConvert.SerializeObject(body);
                try
                {
                    using (var streamWriter = new StreamWriter(httpWebRequest.GetRequestStream()))
                    {
                        streamWriter.Write(json);
                    }
                    var httpResponse = (HttpWebResponse)httpWebRequest.GetResponse();
                    using (var streamReader = new StreamReader(httpResponse.GetResponseStream()))
                    {
                        var responseText = streamReader.ReadToEnd();
                        Console.WriteLine(responseText); 
                        return (responseText);
                    }
                }
                catch (Exception ex)
                {
                    string text = ex.ToString();
                    Console.WriteLine(text);
                    throw ex;
                }
            };
        }
    }
}

