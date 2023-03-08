using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using FitFocus.Services;
using FitFocus.ViewModels;
using Xamarin.Essentials;
using Xamarin.Forms;
using Xamarin.Forms.Xaml;

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
        }

        protected override void OnAppearing()
        {
            Device.BeginInvokeOnMainThread(() =>
            {
                scanView.IsVisible = true;
                scanView.IsEnabled = true;
                scanView.IsAnalyzing = true;
                scanView.IsScanning = true;
            });
        }

        private void ScanView_OnScanResult(ZXing.Result result)
        {
            // Login system
            string aa = ApiService.PostToAPIEndpoint_Authentify(result.Text);
            int i = 0;
        }
    }
}
