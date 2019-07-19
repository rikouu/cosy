import PageLayout from '@/layouts/PageLayout'

const topicRoutes = [
  {
    path: 'topic',
    component: PageLayout,
    meta: {
      title: '专题',
      hideChildrenInMenu: true
    },
    children: [
      {
        path: '',
        name: 'topic.index',
        component: () => import('@/views/topics/List.vue'),
        meta: {
          title: '专题列表'
        }
      },
      {
        path: 'create',
        name: 'topic.create',
        component: () => import('@/views/topics/Update.vue'),
        meta: {
          title: '新建专题'
        }
      },
      {
        path: ':id/edit',
        name: 'topic.edit',
        component: () => import('@/views/topics/Update.vue'),
        props: true,
        meta: {
          title: '编辑专题'
        }
      },
      {
        path: ':id',
        name: 'topic.detail',
        component: () => import('@/views/topics/Detail.vue'),
        props: true,
        meta: {
          title: '专题详情'
        }
      }
    ]
  }
]

export default topicRoutes
