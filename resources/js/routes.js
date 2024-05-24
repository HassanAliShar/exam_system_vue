import * as Vue from 'vue';
import { createRouter, createWebHistory } from 'vue-router';

import Login from './components/auth/login.vue';
import Register from './components/auth/register.vue';

import AdminDashboard from './components/dashboard/admin.vue';
import UserDashboard from './components/dashboard/user.vue';
import UserExams from './components/users/exams/manage.vue';
import UserExamStart from './components/users/exams/start.vue';

import UserExamResultView from './components/users/results/view.vue';
import UserExamResults from './components/users/results/manage.vue';

import SubjectIndex from './components/subjects/manage.vue';
import PapersIndex from './components/papers/manage.vue';

import PapersQuestions from './components/papers/questions/manage.vue';
import AddQuestions from './components/papers/questions/add.vue';
import EditQuestion from './components/papers/questions/edit.vue';

import UserComponent from './components/users/manage.vue';
import AssignPaper from './components/papers/assign_exams/assign.vue';
import UserPapers from './components/papers/assign_exams/manage.vue';
import UserPapersEdit from './components/papers/assign_exams/edit.vue';

const routes = [
    {
        path: '/login',
        component: Login,
        name: 'login' ,
        meta: { requiresAuth: false }

    },
    {
         path: '/register',
         component: Register,
         name: 'register',
         meta: { requiresAuth: false }
     },
     {
         path: '/',
         component: AdminDashboard,
         name: 'admin_dashboard',
         meta: { requiresAuth: true }
     },
     {
         path: '/user',
         component: UserDashboard,
         name: 'user_dashboard',
         meta: { requiresAuth: true }
     },
     {
        path: '/users/exams',
        component: UserExams,
        name: 'user_exams',
        meta: { requiresAuth: true }
    },
    {
        path: '/users/exams/start/:id',
        component: UserExamStart,
        name: 'user_exams_start',
        meta: { requiresAuth: true }
    },
    {
        path: '/users/exams/results',
        component: UserExamResults,
        name: 'user_exams_results',
        meta: { requiresAuth: true }
    },
    {
        path: '/users/exams/result-view/:id',
        component: UserExamResultView,
        name: 'user_exams_result_view',
        meta: { requiresAuth: true }
    },
    {
        path: '/subject',
        component: SubjectIndex,
        name: 'subjectManage',
        meta: { requiresAuth: true }
    },
    {
        path: '/papers',
        component: PapersIndex,
        name: 'papersManage',
        meta: { requiresAuth: true }
    },
    {
        path: '/papers-questions/:id',
        component: PapersQuestions,
        name: 'papersQuestion',
        meta: { requiresAuth: true }
    },
    {
        path: '/papers-questions/add/:id',
        component: AddQuestions,
        name: 'addQuestions',
        meta: { requiresAuth: true }
    },

    {
        path: '/papers-questions/edit/:id',
        component: EditQuestion,
        name: 'EditQuestion',
        meta: { requiresAuth: true }
    },

    {
        path: '/users/manage',
        component: UserComponent,
        name: 'userManage',
        meta: { requiresAuth: true }

    },
    {
        path: '/users/assign-paper/:id',
        component: AssignPaper,
        name: 'assignPaper',
        meta: { requiresAuth: true }

    },
    {
        path: '/users/papers',
        component: UserPapers,
        name: 'userPapers',
        meta: { requiresAuth: true }
    },
    {
        path: '/users/papers/edit/:id',
        component: UserPapersEdit,
        name: 'userPapersEdit',
        meta: { requiresAuth: true }
    }
  ];
//   Vue.use(VueRouter);

  const router = createRouter({
    history: createWebHistory(),
    routes
  });

  router.beforeEach((to, from, next) => {
    if (to.matched.some((record) => record.meta.requiresAuth)) {
        if (!localStorage.getItem('token')) {
            next({ name: 'login' });
        } else {
            next();
        }
    }
    else {
      next();
    }
  });

  export default router;
