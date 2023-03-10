using System;
using System.Threading.Tasks;
using Xamarin.Forms;

namespace FitFocus.Models
{
    public class User
    {
        public string SecureString;
        public string Username;
        public string Policies;
        public bool IsAuthenticated;
        public bool SaveLogin;

        public User()
        {
            this.IsAuthenticated = false;
        }

        /// <summary>
        /// Set the values from login to the app Database
        /// </summary>
        /// <returns></returns>
        public async Task AsyncPersistsPropertiesOnSuccessfulLogin()
        {
            await AsyncTryPersistObject("SecureString", this.SecureString);
            await AsyncTryPersistObject("SaveLogin", this.SaveLogin);
            await App.Current.SavePropertiesAsync();
        }

        /// <summary>
        /// Set the value to the db
        /// </summary>
        /// <param name="key"></param>
        /// <param name="obj"></param>
        /// <param name="IsString"></param>
        /// <returns></returns>
        private async Task AsyncTryPersistObject(string key, object obj)
        {
            Application.Current.Properties[key] = obj;
        }
    }

    public class Response
    {
        public string Code { get; set; }
        public string Status { get; set; }
        public string Message { get; set; }
        public string Content { get; set; }
    }

    public class DeserializedUser
    {
        public string Username;
        public string Policies;

        public User ToUser()
        {
            User user = new User();
            user.Username = this.Username;
            user.Policies = this.Policies;
            user.IsAuthenticated = true;
            return user;
        }
    }
}

