import BasicLayout from '@/layout/BasicLayout'

export const routes = [
  {
    path: '/',
    component: BasicLayout,
    children: [
      {
        path: '/',
        component: () => import('@/views/dashboard/index.vue'),
        name: 'Dashboard',
        meta: { title: 'Dashboard' }
      }
    ]
  }
]

export const asyncRouterMap = [

]

export default routes
