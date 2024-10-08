import { createSlice, PayloadAction } from '@reduxjs/toolkit'
import { User } from 'src/types/models/user'
import { getCookie, setCookie, removeCookie } from 'typescript-cookie'

const API_TOKEN = 'news_api_token'

// Define a type for the slice state
export interface AuthState {
	token: string | null
	user: User | null
}

// Define the initial state using that type
const initialState: AuthState = {
	token: getCookie(API_TOKEN)!,
	user: null
}

export const authSlice = createSlice({
	name: 'auth',
	initialState,
	reducers: {
		setToken(state, action: PayloadAction<string | null>) {
			state.token = action.payload
			setCookie(API_TOKEN, action.payload)
		},
		setUser(state, action: PayloadAction<User | null>) {
			state.user = action.payload
		},
		logout(state) {
			state.token = null
			state.user = null
			removeCookie(API_TOKEN)
		}
	}
})

export const { setToken, setUser, logout } = authSlice.actions

export default authSlice.reducer
