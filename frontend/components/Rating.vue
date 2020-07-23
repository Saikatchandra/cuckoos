<template>
    <div class="rating-wrap mt-2">
        <span v-for="rating in singleReviewRating()" :key="rating.id">
            <i v-if="rating.star > 0.5" class="fas fa-star active"></i>
            <i v-else-if="rating.star > 0.4" class="fas fa-star-half-alt active"></i>
            <i v-else class="far fa-star"></i>
        </span>
    </div>
</template>

<script>
export default {
    props: ['stars'],
    data(){
        return {
            startLimit: [1,2,3,4,5],
        }
    },
    methods: {
        singleReviewRating(){
            let starArray = [];
            let rating = this.stars;
            let id = 1;

            this.startLimit.forEach(index => {
                if(rating > 0.9){
                    starArray.push({ id: id, star: 1})
                }else if(rating > 0.4){
                    starArray.push({ id: id, star: 0.5});
                }else {
                    starArray.push({ id: id, star: 0});
                }
                id++;
                rating--;
            });

            return starArray;
        },
    }
}
</script>

<style scoped lang="scss">
    .rating-wrap {
        span {
            i {
                color: #ccc;
                &.active {
                    color: orange;
                }
            }
        }
    }
</style>