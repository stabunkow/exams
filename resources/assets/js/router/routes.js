import Main from '../views/layout/main'
import Home from '../views/home/home'
import Login from '../views/login/login'
import Subjects from '../views/subjects/index'
import ExerciseBooks from '../views/exerciseBooks/index'
import ExerciseBook from '../views/exerciseBooks/show'
import ExerciseBookQuestions from '../views/exerciseBooks/questions/index'
import AuthUserWrongQuestions from '../views/user/wrongQuestions/index'

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
                component: Subjects,
                name: 'subjects'
            },
            {
                path: '/exercise_books',
                component: ExerciseBooks,
                name: 'exerciseBooks'
            },
            {
                path: '/exercise_books/:id',
                component: ExerciseBook,
                name: 'exerciseBook'
            },
            {
                path: '/user/wrong_questions',
                component: AuthUserWrongQuestions,
                name: 'authUserWrongQuestions'
            }
        ]
    },
    {
        path: '/exercise_books/:id/questions',
        component: ExerciseBookQuestions,
        name: 'exerciseBookQuestions'
    }
]