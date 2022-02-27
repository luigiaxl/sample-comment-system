import axios from "axios";
import { defineStore } from "pinia";
import { comment } from "postcss";

export const useCommentsStore = defineStore('comments', {
  state: () => ({
    comments: []
  }),

  actions: {
    /**
     * Set initial list of comments
     * 
     * @param comments an array of comments
     */
    setComments (comments) {
      this.comments = comments
    },

    /**
     * Add one comment at the beginning of the list
     * 
     * @param comment a comment object
     */
    prependComment (comment) {
      this.comments.splice(0, 0, comment)
    },

    setReplies (comment, replies) {
      comment.comments = replies
    },

    prependReply (comment, reply) {
      if (!comment.comments)
        comment.comments = []
        
      comment.comments.splice(0, 0, reply)
    },

    /**
     * Fetch list of comments from server.
     * Save list to the store.
     */
    getComments () {
      const uri = '/api/comments';

      axios.get(uri)
        .then(result => this.setComments(result.data))
    },

    /**
     * Submit new comment to server.
     * Add new comment to the store.
     * 
     * @param newComment object containing new comment details
     */
    postComment (newComment) {
      const uri = '/api/comments';

      axios.post(uri, newComment)
        .then(result => this.prependComment(result.data))
    },

    getReplies (comment) {
      const uri = `/api/comments/${comment.id}/replies`

      axios.get(uri)
        .then(result => this.setReplies(comment, result.data))
    },

    postReply (comment, newReply) {
      const uri = `/api/comments/${comment.id}/reply`

      axios.post(uri, newReply)
        .then(result => this.prependReply(comment, result.data))
    }
  }
})