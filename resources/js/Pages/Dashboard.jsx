import Dropdown from "@/Components/Dropdown";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import Guest from "@/Layouts/GuestLayout";
import { Layout } from "@/Layouts/Layout";
import { Head, Link, useForm } from "@inertiajs/react";
import { toast } from "react-toastify";

export default function Dashboard({ auth, properties, flash }) {
    const {
        post,
        errors,
        data,
        setData,
        processing,
        reset,
        recentlySuccessful,
    } = useForm({
        title: "",
        description: "",
        price: "",
        type: "",
    });
    function handleSubmit(e) {
        e.preventDefault();
        post("/post", {
            onSuccess: () => {
                reset();
            },
        });
    }

    return (
        <>
            <Head title="Dashboard" />
            {flash.status == "error" ? (
                <div className="hidden">{toast.error(flash.message)}</div>
            ) : (
                <div className="hidden">{toast.success(flash.message)}</div>
            )}
            <Head title="Welcome" />
            <Layout>
                <div className="container mx-auto">
                    {auth.user ? (
                        <div className="container mx-auto sm:px-6 lg:px-8 max-w-7xl px-4 pt-4">
                            <div className="text-center">
                                Add new properties:
                            </div>
                            {processing && <span>Processing...</span>}

                            <div>
                                <form
                                    className="flex flex-col"
                                    onSubmit={handleSubmit}
                                >
                                    <label htmlFor="">Title</label>
                                    {errors.title && (
                                        <span className="text-red-600">
                                            {errors.title}
                                        </span>
                                    )}
                                    <input
                                        className="block py-3 my-3"
                                        type="text"
                                        name="title"
                                        value={data.title}
                                        onChange={(e) =>
                                            setData("title", e.target.value)
                                        }
                                    />
                                    <label htmlFor="">Description</label>
                                    {errors.description && (
                                        <span className="text-red-600">
                                            {errors.description}
                                        </span>
                                    )}
                                    <input
                                        className="block py-3 my-3"
                                        type="text"
                                        name="description"
                                        value={data.description}
                                        onChange={(e) =>
                                            setData(
                                                "description",
                                                e.target.value
                                            )
                                        }
                                    />
                                    <label htmlFor="">Price</label>
                                    {errors.price && (
                                        <span className="text-red-600">
                                            {errors.price}
                                        </span>
                                    )}
                                    <input
                                        className="block py-3 my-3"
                                        type="text"
                                        name="price"
                                        value={data.price}
                                        onChange={(e) =>
                                            setData("price", e.target.value)
                                        }
                                    />
                                    <label htmlFor="">Type</label>
                                    {errors.type && (
                                        <span className="text-red-600">
                                            {errors.type}
                                        </span>
                                    )}
                                    <input
                                        className="block py-3 my-3"
                                        type="text"
                                        name="type"
                                        value={data.type}
                                        onChange={(e) =>
                                            setData("type", e.target.value)
                                        }
                                    />
                                    <button
                                        type="submit"
                                        className="border py-2 bg-black text-white"
                                    >
                                        Add
                                    </button>
                                </form>
                            </div>
                        </div>
                    ) : (
                        ""
                    )}
                    <div className="container mt-0 mx-auto lg:px-8 max-w-7xl">
                        <div className="bg-white   sm:px-6 lg:px-8 ">
                            <div className=" overflow-hidden shadow-sm sm:rounded-lg">
                                hi
                                {properties.map((e, i) => {
                                    return (
                                        <div className="" key={i}>
                                            {e.title}
                                        </div>
                                    );
                                })}
                            </div>
                        </div>
                    </div>
                </div>
            </Layout>
        </>
    );
}
