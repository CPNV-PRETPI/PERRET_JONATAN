using System;
using System.Collections.Generic;
using FitFocus.Models;

namespace FitFocus.Services
{
	public static class WorkoutsManager
	{
		public static List<Workout> GetHomeWorkouts()
		{
			List<Workout> workouts = new List<Workout>();

			// Get the workouts list from api

			for (int i = 0; i < 10; i++)
			{
				Workout workout = new Workout("Workout "+i, "1h");
				for (int j = 0; j < 4; j++)
				{
					workout.Series.Add(new Serie("Serie " + j, 3, new DateTime().AddSeconds(90), new DateTime().AddSeconds(120), new Excercise("Ex", "Until failure")));
				}

            }

			return workouts;
		}
	}
}

