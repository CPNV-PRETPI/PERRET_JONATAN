using System;
using System.Collections.ObjectModel;
using System.Diagnostics;
using System.Threading.Tasks;

using Xamarin.Forms;

using FitFocus.Models;
using FitFocus.Views;
using FitFocus.Services;

namespace FitFocus.ViewModels
{
    public class HomeViewModel : BaseViewModel
    {
        ObservableCollection<Workout> Workouts;
        public HomeViewModel()
        {
            Title = "HomePage";
        }

        public void OnAppearing()
        {
            foreach (Workout workout in WorkoutsManager.GetHomeWorkouts())
            {
                Workouts.Add(workout);
            }
        }
    }
}
