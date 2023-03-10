using System;
using System.Collections.Generic;

namespace FitFocus.Models
{
    public class Workout
    {
        public string Id { get; set; }
        public string Name { get; set; }
        public string ApproxTime { get; set; }
        public List<Serie> Series;

        public Workout(string name, string approxTime, List<Serie> series = null)
        {
            if (series is null) series = new List<Serie>();

            this.Id = new Guid().ToString();
            this.Name = name;
            this.ApproxTime = approxTime;
            this.Series = series;
        }
    }

    public class Serie
    {
        public string Name;
        public int NumberOfSets;
        public DateTime TimeBetweenSets;
        public DateTime TimeAfterSets;
        public Excercise Excercise;

        public Serie(string name, int numberOfSets, DateTime TimeBetweenSets, DateTime TimeAfterSets, Excercise excercise)
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

        public Excercise(string name, string numberOfRepetitions)
        {
            this.Name = name;
            this.NumberOfRepetitions = numberOfRepetitions;
        }
    }
}
