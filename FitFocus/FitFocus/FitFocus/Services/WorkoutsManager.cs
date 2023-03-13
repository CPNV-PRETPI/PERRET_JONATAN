using System;
using System.Collections.Generic;
using System.Threading.Tasks;
using FitFocus.Models;

namespace FitFocus.Services
{
	public static class WorkoutsManager
	{
		public async static Task<List<Workout>> GetHomeWorkouts()
		{
			List<Workout> workouts = new List<Workout>();

			// Get the workouts list from api
			
			//workouts = await ApiService.PostToAPIEndpoint_GetWorkouts(App.CurrentUser.SecureString);

			for (int i = 0; i < 10; i++)
			{
				List<Serie> series = new List<Serie>();
				for (int j = 0; j < 4; j++)
				{
					series.Add(new Serie("Serie" + j, 3, "1min 30", "2min", new Excercise("Ex", "Until failure")));
				}
				Workout workout = new Workout("Workout" + i, "1h", "https://fitfocus.cld.education//Assets//Images//TPI_WorkoutBackground.png", series);
				workouts.Add(workout);
			}

			return workouts;
		}
	}
}

