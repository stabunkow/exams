import Main from '../views/layout/main'
import Home from '../views/home/home'
import Login from '../views/login/login'
import SubjectsIndex from '../views/subjects/index'
import ExerciseBooksIndex from '../views/exerciseBooks/index'
import ExerciseBook from '../views/exerciseBooks/show'

export default [
    {
        path: '/',
        redirect: '/home',
        component: Main,
        children: [
            {
                path: '/home',
                component: Home,
                name: 'home'
            },
            {
                path: '/login',
                component: Login,
                name: 'login'
            },
            {
                path: '/subjects',
                component: SubjectsIndex,
                name: 'subjects.index'
            },
            {
                path: '/exercise_books',
                component: ExerciseBooksIndex,
                name: 'exerciseBooks.index'
            },
            {
                path: '/exercise_books/:id',
                component: ExerciseBook,
                name: 'exerciseBooks.show'
            }
        ]
    }
]