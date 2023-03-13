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
			
			workouts = await ApiService.PostToAPIEndpoint_GetWorkouts(App.CurrentUser.SecureString);

			return workouts;
		}
	}
}

