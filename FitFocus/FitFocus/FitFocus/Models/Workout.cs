using System;
using System.Collections.Generic;

namespace FitFocus.Models
{
    public class Workout
    {
        //public string Id { get; set; }
        public string Name { get; set; }
        public string ApproxTime { get; set; }
        public string CoverImageUrl { get; set; }
        public List<Serie> Series;

        public string SeriesNumber
        {
            get
            {
                return Series.Count.ToString();
            }
        }

        public Workout()
        {

        }

        public Workout(string name, string approxTime, string coverImageUrl, List<Serie> series = null)
        {
            if (series is null) series = new List<Serie>();

            //this.Id = new Guid().ToString();
            this.Name = name;
            this.ApproxTime = approxTime;
            this.CoverImageUrl = coverImageUrl;
            this.Series = series;
        }
    }

    public class Serie
    {
        public string Name;
        public int NumberOfSets;
        public string TimeBetweenSets;
        public string TimeAfterSets;
        public Excercise Excercise;

        public Serie()
        {

        }

        public Serie(string name, int numberOfSets, string TimeBetweenSets, string TimeAfterSets, Excercise excercise)
        {
            this.Name = name;
            this.NumberOfSets = numberOfSets;
            this.TimeBetweenSets = TimeBetweenSets;
            this.TimeAfterSets = TimeAfterSets;
            this.Excercise = excercise;
        }
    }

    public class Excercise
    {
        public string Name;
        public string NumberOfRepetitions;
        public string PathToVideo;
        public string PathToCoverImage;

        public Excercise()
        {

        }

        public Excercise(string name, string numberOfRepetitions)
        {
            this.Name = name;
            this.NumberOfRepetitions = numberOfRepetitions;
        }
    }

    public class WorkoutResponse
    {
        public string Code;
        public string Status;
        public string Message;
        public string Content;
    }

    public class WorkoutList
    {
        public List<Workout> Workouts;
    }
}
