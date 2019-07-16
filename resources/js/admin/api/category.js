import request from '@/utils/request'

export function list (params) {
  return request({
    url: '/category',
    method: 'get',
    params
  })
}

export function store (data) {
  return request({
    url: '/category',
    method: 'post',
    data
  })
}

export function update (data) {
  const id = data.id
  return request({
    url: `/category/${id}`,
    method: 'post',
    data
  })
}

export function show (data) {
  const id = data.id
  return request({
    url: `/category/${id}`,
    method: 'get',
    data
  })
}

export function destroy (data) {
  const id = data.id
  return request({
    url: `/category/${id}`,
    method: 'delete'
  })
}
