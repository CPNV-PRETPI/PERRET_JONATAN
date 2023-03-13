using System;
using System.Collections.ObjectModel;
using System.Diagnostics;
using System.Threading.Tasks;

using Xamarin.Forms;

using FitFocus.Models;
using FitFocus.Views;
using FitFocus.Services;
using System.Collections.Generic;

namespace FitFocus.ViewModels
{
    public class HomeViewModel : BaseViewModel
    {
        public ObservableCollection<Workout> Workouts { get; }

        public HomeViewModel()
        {
            Workouts = new ObservableCollection<Workout>();
            Title = "HomePage";
        }

        public async void Refreshing()
        {
            IsBusy = true;
            List<Workout> list = await WorkoutsManager.GetHomeWorkouts();
            foreach (Workout workout in list)
            {
                Workouts.Add(workout);
            }
            IsBusy = false;
        }
    }
}
