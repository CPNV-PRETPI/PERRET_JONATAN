using System;
using System.Collections.Generic;
using System.Diagnostics;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using FitFocus.Models;
using FitFocus.Services;
using FitFocus.ViewModels;
using Xamarin.Essentials;
using Xamarin.Forms;
using Xamarin.Forms.Xaml;
using ZXing;

namespace FitFocus.Views
{
    [XamlCompilation(XamlCompilationOptions.Compile)]
    public partial class LoginPage : ContentPage
    {
        public LoginPage()
        {
            InitializeComponent();
            this.BindingContext = new LoginViewModel();
            scanView.OnScanResult += ScanView_OnScanResult;
            scanView.Options.DelayBetweenAnalyzingFrames = 5;
            scanView.Options.DelayBetweenContinuousScans = 5;
        }

        protected override void OnAppearing()
        {
            Device.BeginInvokeOnMainThread(() =>
            {
                // Camera initialisation
                scanView.IsVisible = true;
                scanView.IsEnabled = true;
                scanView.IsAnalyzing = true;
                scanView.IsScanning = true;
            });

            // Load the app datas if exists
            LoadAppDatas();

            CheckboxSaveSecurestring.IsChecked = App.CurrentUser.SaveLogin;
        }

        private void LoadAppDatas()
        {
            try
            {
                // Login Properties
                App.CurrentUser.SecureString = (string)Application.Current.Properties["SecureString"];
                App.CurrentUser.SaveLogin = (bool)Application.Current.Properties["SaveLogin"];
            }
            catch (Exception ex)
            {
                Debug.WriteLine(ex.ToString());
            }
        }

        private void ScanView_OnScanResult(ZXing.Result result)
        {
            // Activate the activaty indicator
            ActivityIndicatorManipulation(true);

            // Desactivate Scanner
            CameraManipulation(false);

            // Login system
            Task.Run(async () =>
            {
                await LoginSystem(result.Text);
            });
        }

        void SignInButton_Clicked(System.Object sender, System.EventArgs e)
        {
            // Activate the activaty indicator
            ActivityIndicatorManipulation(true);

            // Desactivate Scanner
            CameraManipulation(false);
            if (!App.CurrentUser.SaveLogin)
            {
                Device.BeginInvokeOnMainThread(async () =>
                {
                    await DisplayAlert("Warning", "You don't have registered credentials, try to scan a qr-code", "OK").ContinueWith(tsk =>
                    {
                        CameraManipulation(true);
                        ActivityIndicatorManipulation(false);
                        return;
                    });
                });
            }
            else
            {
                // Login system
                Task.Run(async () =>
                {
                    await LoginSystem(App.CurrentUser.SecureString);
                });
            }
        }

        public async Task LoginSystem(string secureString)
        {
            User user = await ApiService.PostToAPIEndpoint_Authentify(secureString);
            if (user.IsAuthenticated)
            {
                Device.BeginInvokeOnMainThread(async () =>
                {
                    App.CurrentUser = user;
                    if (CheckboxSaveSecurestring.IsChecked)
                    {
                        App.CurrentUser.SaveLogin = true;
                        await App.CurrentUser.AsyncPersistsPropertiesOnSuccessfulLogin();
                    }
                    await Shell.Current.GoToAsync($"//{nameof(HomePage)}");
                });
            }
            else
            {
                Device.BeginInvokeOnMainThread(async () =>
                {
                    ActivityIndicatorManipulation(false);
                    await DisplayAlert("Error", "Your credentials are invalid", "OK").ContinueWith(tsk => {
                        CameraManipulation(true);
                    });
                });
            }
        }

        private void CameraManipulation(bool valueToSet)
        {
            Device.BeginInvokeOnMainThread(() =>
            {
                scanView.IsScanning = valueToSet;
                scanView.IsAnalyzing = valueToSet;
            });
        }

        private void ActivityIndicatorManipulation(bool valueToSet)
        {
            Device.BeginInvokeOnMainThread(() =>
            {
                activityIndicator.IsVisible = valueToSet;
            });
        }

        void Button_Clicked(System.Object sender, System.EventArgs e)
        {
            CameraManipulation(false);
            Shell.Current.GoToAsync($"//{nameof(HomePage)}");
        }
    }
}