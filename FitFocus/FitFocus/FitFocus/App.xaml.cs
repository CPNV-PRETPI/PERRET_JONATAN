using System;
using Xamarin.Forms;
using Xamarin.Forms.Xaml;
using FitFocus.Services;
using FitFocus.Views;
using FitFocus.Models;

namespace FitFocus
{
    public partial class App : Application
    {
        public static User CurrentUser { get; set; }

        public App ()
        {
            InitializeComponent();
            CurrentUser = new User();

            DependencyService.Register<MockDataStore>();
            MainPage = new AppShell();
        }

        public App(User user)
        {
            InitializeComponent();
            CurrentUser = user;

            DependencyService.Register<MockDataStore>();
            MainPage = new AppShell();
        }

        protected override void OnStart ()
        {
        }

        protected override void OnSleep ()
        {
        }

        protected override void OnResume ()
        {
        }
    }
}

