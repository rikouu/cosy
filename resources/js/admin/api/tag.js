import request from '@/utils/request'

export function index (params) {
  return request({
    url: '/tag',
    method: 'get',
    params
  })
}

export function store (data) {
  return request({
    url: '/tag',
    method: 'post',
    data
  })
}

export function update (id, data) {
  delete data['id']
  return request({
    url: `/tag/${id}`,
    method: 'post',
    data
  })
}

export function destroy (id) {
  return request({
    url: `/tag/${id}`,
    method: 'delete'
  })
}
