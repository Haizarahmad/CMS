@extends('layouts.superadmin')

@section('title', 'Admin-Dashboard')

@section('superadmin-content')
    <div class="flex items-center justify-between h-15">
        <h2 class="text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Welcome, admin 👋
        </h2>
    </div>
    <hr class="my-4" />
        <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800 mt-4">
            <div class="p-3 mr-4 text-orange-500 bg-orange-100 rounded-full dark:text-orange-100 dark:bg-orange-500"></div>
            <div class="text-xl">
                <p class="font-medium text-gray-600 dark:text-gray-400">Total students</p>
                <p class="font-semibold text-gray-700 dark:text-gray-200">
                {{ $total_students }}
                </p>
            </div>
        </div>
       <div class="grid 2xl:grid-cols-3 grid-rows-2 gap-6 mt-4">

        <div class="flex flex-col items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800 2xl:col-span-1">
            <h1 class="text-xl font-medium text-gray-600 dark:text-gray-400">Total students by gender</h1>

            <div class="w-80 mt-6">
            <canvas id="myChart"></canvas>
            </div>
            <script>
                const ctx = document.getElementById('myChart');

                new Chart(ctx, {
                    type: 'doughnut',
                    data: {
                    labels: ['Male', 'Female'],
                    datasets: [{
                        label: 'Total of students',
                        data: [{{ $male_count }}, {{ $female_count }}],
                        borderWidth: 1
                    }]
                    },
                    options: {
                    scales: {
                        y: {
                        beginAtZero: true
                        }
                    }
                    }
                });
            </script>
        </div>

        <div class="flex flex-col items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800 2xl:col-span-2">
            <p class="text-xl font-medium text-gray-600 dark:text-gray-400">Total students by subject</p>          
            <div class="2xl:w-full 2xl:max-h-80 flex justify-center mt-6">
                <canvas id="myChart-2"></canvas>
                <script>
                    const ctx_2 = document.getElementById('myChart-2');
                    const subjectLabels = {!! json_encode(array_keys($subjectStudentCounts)) !!};
                    const subjectData = {!! json_encode(array_values($subjectStudentCounts)) !!};
                    new Chart(ctx_2, {
                        type: 'bar',
                        data: {
                        labels: subjectLabels,
                        datasets: [{
                            label: 'Total of students',
                            data: subjectData,
                            borderWidth: 1,
                        }]
                        },
                        options: {
                        scales: {
                            y: {
                            beginAtZero: true
                            }
                        }
                        }
                    });
                </script>
            </div>
        </div>  
       </div>
@endsection
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>