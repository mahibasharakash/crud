const apiRoutes = {

    login: '/auth/login',
    registration: '/auth/registration',
    forgot: '/auth/forgot',
    reset: '/auth/reset',
    verification: '/auth/verification',

    user: '/profile/user-details',
    changeDetails: '/profile/change-details',
    changePassword: '/profile/change-password',
    deleteAccount: '/profile/delete-account',
    uploadImage: '/profile/upload-image',
    removeImage: '/profile/remove-image',
    logout: '/profile/logout',

    listCrud: '/crud/list',
    createCrud: '/crud/store',
    showCrud: '/crud/show',
    updateCrud: '/crud/update',
    deleteCrud: '/crud/delete',

}

export default apiRoutes;
