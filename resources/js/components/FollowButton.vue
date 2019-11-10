<template>
    <div>
        <button class="btn btn-sm btn-primary" @click="followProfile" v-text="follow">
            S'abonner
        </button>
    </div>
</template>

<script>
    export default {
        props : [
            'profileId',
            'isFollowing'
        ],
        data : function () {
            return {
                status: this.isFollowing
            }
        },
        methods : {
            followProfile() {
                axios.post('/follows/' + this.profileId)
                    .then(response => {
                        this.status = !this.status
                    })
                    .catch(err => {
                        if(err.response.status === 401) {
                            window.location = '/login'
                        }
                    })
            }
        },

        computed : {
            follow() {
                return (this.status)
                    ? 'Ne plus suivre'
                    : 'S\'abonner'
            }
        }
    }
</script>
