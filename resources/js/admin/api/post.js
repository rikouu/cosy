import request from '@/utils/request'

export function index (params) {
  return request({
    url: '/post',
    method: 'get',
    params
  })
}

export function store (data) {
  return request({
    url: '/post',
    method: 'post',
    data
  })
}

export function update (data) {
  const id = data.id
  return request({
    url: `/post/${id}`,
    method: 'post',
    data
  })
}

export function destroy (data) {
  const id = data.id
  return request({
    url: `/post/${id}`,
    method: 'delete'
  })
}
